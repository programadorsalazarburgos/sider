  <style>
        .resp-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }
        .resp-iframe {
            position: absolute;
            top: 0;
            left: 12px;
            width: 96% !important;
            height: 100%;
            border: 0;
        }
  </style>

<div ng-controller="SoporteCrtl">

    <div class="row">
            {{-- <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://dashboard.tawk.to/#/messaging" allowfullscreen></iframe>
            </div> --}}
            <div class="resp-container">
                    <iframe class="resp-iframe" src="https://dashboard.tawk.to/#/messaging" gesture="media"  allow="encrypted-media" allowfullscreen></iframe>
                </div>
    </div>
</div>
