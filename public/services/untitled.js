SeriesApp.factory("PrDisciplinaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postprdisciplinas/:id", null, {
        'update': { 'method':'PUT' }
    });
});