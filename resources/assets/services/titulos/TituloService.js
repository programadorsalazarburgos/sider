SeriesApp.factory("TituloService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/posttitulos/:id", null, {
        'update': { 'method':'PUT' }
    });
});