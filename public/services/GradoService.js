SeriesApp.factory("GradoService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postgrados/:id", null, {
        'update': { 'method':'PUT' }
    });
});