SeriesApp.factory("GrupoProgramaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postgruposprogramas/:id", null, {
        'update': { 'method':'PUT' }
    });
});