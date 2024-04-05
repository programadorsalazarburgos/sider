SeriesApp.factory("PuntoAtencionService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postpuntoatencion/:id", null, {
        'update': { 'method':'PUT' }
    });
});