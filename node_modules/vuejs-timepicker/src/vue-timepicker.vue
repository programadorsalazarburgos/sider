<script>
const CONFIG = {
  HOUR_TOKENS: ['HH', 'H', 'hh', 'h', 'kk', 'k'],
  MINUTE_TOKENS: ['mm', 'm'],
  SECOND_TOKENS: ['ss', 's'],
  APM_TOKENS: ['A', 'a']
}

export default {
  name: 'VueTimepicker',

  props: {
    value: {
      required: true,
      type: Object
    },

    hideClearButton: {
      type: Boolean
    },

    format: {
      type: String,
      default: 'HH:mm'
    },

    minuteInterval: {
      type: Number,
      default: 1,
      validator: val => {
        if (val < 0) {
          throw new Error('minute-interval must be greater than 0')
        }
        return true;
      }
    },

    secondInterval: {
      type: Number,
      default: 1,
      validator: val => {
        if (val < 0) {
          throw new Error('second-interval must be greater than 0')
        }
        return true;
      }
    },

    disabled: { type: Boolean },

    disabledValues: {
      type: Object,
      default: () => { return { hour: [], minute: [], second: [], apm: [] } }
    }
  },

  data () {
    return {
      showDropdown: false
    }
  },

  computed: {
    displayTime () {
      let formatString = this.format

      if (this.value[this.hourType]) {
        formatString = formatString.replace(new RegExp(this.hourType, 'g'), this.value[this.hourType])
      }
      if (this.value[this.minuteType]) {
        formatString = formatString.replace(new RegExp(this.minuteType, 'g'), this.value[this.minuteType])
      }
      if (this.value[this.secondType] && this.secondType) {
        formatString = formatString.replace(new RegExp(this.secondType, 'g'), this.value[this.secondType])
      }
      if (this.value[this.apmType] && this.apmType) {
        formatString = formatString.replace(new RegExp(this.apmType, 'g'), this.value[this.apmType])
      }

      return formatString
    },

    showClearBtn () {
      return !!this.value[this.hourType] || !!this.value[this.minuteType]
    },

    hourType () {
      return this.checkAcceptingType(CONFIG.HOUR_TOKENS, this.format, 'HH')
    },

    minuteType () {
      return this.checkAcceptingType(CONFIG.MINUTE_TOKENS, this.format, 'mm')
    },

    secondType () {
      return this.checkAcceptingType(CONFIG.SECOND_TOKENS, this.format)
    },

    apmType () {
      return this.checkAcceptingType(CONFIG.APM_TOKENS, this.format)
    },

    hours () {
      const hoursCount = this.isTwelveHours ? 12 : 24

      let hours = []

      for (let i = 0; i < hoursCount; i++) {
        switch(this.hourType) {
          case 'H':
            hours.push( String(i) )
            break;
          case 'HH':
            hours.push( ('0' + i).substr(-2, 2) )
            break;
          case 'h':
          case 'k':
            hours.push( String(i + 1) )
            break;
          case 'hh':
          case 'kk':
            hours.push( ('0' + String(i + 1)).substr(-2, 2) )
            break;
        }
      }

      return hours;
    },

    minutes () {
      let minutes = []

      for (let i = 0; i < 60; i += this.minuteInterval) {
        switch(this.minuteType) {
          case 'm':
            minutes.push(String(i))
            break;
          case 'mm':
            minutes.push( ('0' + i).substr(-2, 2) )
            break;
        }
      }

      return minutes
    },

    seconds () {
      let seconds = []

      for (let i = 0; i < 60; i += this.secondInterval) {
        switch(this.secondType) {
          case 's':
            seconds.push(i)
            break;
          case 'ss':
            seconds.push( ('0' + i).substr(-2, 2) )
            break;
        }
      }

      return seconds
    },

    apms () {
      switch (this.apmType) {
        case 'A':
          return ['AM', 'PM']
        case 'a':
          return ['am', 'pm']
        default:
          return []
      }
    },

    isTwelveHours () {
      return this.hourType === 'h' || this.hourType === 'hh'
    },

    isPastNoon () {
      return this.apm === 'pm' || this.apm === 'PM'
    },
  },

  methods: {
    checkAcceptingType (validValues, formatString, fallbackValue) {
      if (!validValues || !formatString || !formatString.length) { return '' }

      const length = validValues.length

      for (let i = 0; i < length; i++) {
        if (formatString.indexOf(validValues[i]) > -1) {
          return validValues[i]
        }
      }

      return fallbackValue || ''
    },

    toggleDropdown () {
      this.showDropdown = !this.showDropdown && !this.disabled
      if (!this.showDropdown) {
        this.$emit('blur', {
          ...this.value
        })
      } else {
        // focus on the first select element
        setTimeout(() => {this.$el.querySelector("select.hours").focus();}, 0);
      }
    },

    clearTime () {
      let time = {}

      time[this.hourType] = ''
      time[this.minuteType] = ''
      time[this.secondType] = ''

      this.apm = this.apms[0]
      this.$emit('input', time)
    },

    isInsideComponent(el) {
      while (el) {
        if (el === this.$el) {
          return true;
        } else {
          el = el.parentElement;
        }
      }

      return false;
    },

    onLoseFocus(e) {
      if (this.showDropdown && e.relatedTarget && !this.isInsideComponent(e.relatedTarget)) {
        this.toggleDropdown();
      }
    },

    onKeyDown(e) {
      if (e && e.key === "Escape" && this.showDropdown) {
          this.toggleDropdown();
      }
    }
  }
}
</script>

<template>
<span class="time-picker" @keydown="onKeyDown">
  <input class="display-time" :readonly="!disabled" :disabled="disabled" :value="displayTime" type="text" @focusin.stop="toggleDropdown" />
  <span class="clear-btn" v-if="!hideClearButton" v-show="!showDropdown && showClearBtn" @click.stop="clearTime">&times;</span>
  <div class="time-picker-overlay" v-if="showDropdown" @click.stop="toggleDropdown"></div>
  <div class="dropdown" v-show="showDropdown" @focusout="onLoseFocus">
    <div class="select-list">
      <select class="hours" v-model="value[hourType]" @change="$emit('input', value)">
        <option disabled v-text="hourType" value="" class="hint"></option>
        <option
                v-for="hr in hours"
                v-text="hr"
                v-show="disabledValues.hour.indexOf(hr) === -1"
                :class="{active: value[hourType] === hr}">

        </option>
      </select>
      <select class="minutes" v-model="value[minuteType]" @change="$emit('input', value)">
        <option disabled v-text="minuteType" value="" class="hint"></option>
        <option
                v-for="m in minutes"
                v-text="m"
                v-show="disabledValues.minute.indexOf(m) === -1"
                :class="{active: value[minuteType] === m}">

        </option>
      </select>
      <select class="seconds" v-model="value[secondType]" v-if="secondType" @change="$emit('input', value)">
        <option disabled v-text="secondType" value="" class="hint"></option>
        <option
                v-for="s in seconds"
                v-text="s"
                v-show="disabledValues.second.indexOf(s) === -1"
                :class="{active: value[secondType] === s}">

        </option>
      </select>
      <select class="apms" v-model="value[apmType]" v-if="apmType" @change="$emit('input', value)">
        <option disabled v-text="apmType" value="" class="hint"></option>
        <option
                v-for="a in apms"
                v-text="a"
                v-show="disabledValues.apm.indexOf(a) === -1"
                :class="{active: value[apmType] === a}">

        </option>
      </select>
    </div>
  </div>
</span>
</template>

<style>
@import './style/vue-timepicker.css';
</style>
