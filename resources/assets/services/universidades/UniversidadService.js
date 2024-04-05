SeriesApp.factory("UniversidadService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postuniversidades/:id", null, {
        'update': { 'method':'PUT' }
    });
});