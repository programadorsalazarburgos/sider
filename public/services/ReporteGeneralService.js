SeriesApp.factory("ReporteGeneralService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postreportegeneral/:id", null, {
        'update': { 'method':'PUT' }
    });
});