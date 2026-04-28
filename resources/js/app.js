import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('app', {
    quickAddOpen: false,
});

Alpine.start();
