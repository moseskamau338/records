<?php
// Todo: fix issue why not loading  https://github.com/archtechx/tenancy/issues/464
it('returns a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
