<?php

it('redirects the root URL to the Indonesian deforestation status page', function () {
    $this->get('/')
        ->assertRedirect('/id/status-deforestasi-di-indonesia-2025');
});
