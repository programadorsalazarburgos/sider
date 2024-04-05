SeriesApp.factory("LudotecaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postludotecas/:id", null, {
        'update': { 'method':'PUT' }
    });
});