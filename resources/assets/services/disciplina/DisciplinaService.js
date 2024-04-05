SeriesApp.factory("DisciplinaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postdisciplinas/:id", null, {
        'update': { 'method':'PUT' }
    });
});