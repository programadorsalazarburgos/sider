SeriesApp.factory("LugarService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postlugares/:id", null, {
        'update': { 'method':'PUT' }
    });
});