
window._ = require('lodash');

window.Popper = require('./static/js/core/popper.min.js');;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('./static/js/core/jquery.3.2.1.min.js');

    require('./static/js/core/bootstrap.min.js');
    
} catch (e) { }

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key',
//     cluster: 'mt1',
//     encrypted: true
// });




require('./static/js/plugins/bootstrap-switch.js');
require('./static/js/plugins/chartist.min.js');
require('./static/js/plugins/jquery-jvectormap.js');
require('./static/js/plugins/sweetalert2.min.js');
require('./static/js/plugins/nouislider.js');
require('./static/js/plugins/bootstrap-selectpicker.js');
require('./static/js/plugins/jquery.validate.min.js');
require('./static/js/plugins/jquery.bootstrap-wizard.js');
require('./static/js/plugins/bootstrap-table.js');
require('./static/js/light-bootstrap-dashboard.js?v=2.0.1');
require('./static/js/demo.js');