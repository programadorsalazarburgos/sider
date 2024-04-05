SeriesApp.factory("MetasService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postmetas/:id", null, {
        'update': { 'method':'PUT' }
    });
});