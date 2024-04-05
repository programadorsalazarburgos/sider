SeriesApp.factory("ModalidadService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postmodalidades/:id", null, {
        'update': { 'method':'PUT' }
    });
});