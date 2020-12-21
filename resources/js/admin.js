
require('./admin/adminlte');
require('./admin/dashboard');
require('./admin/jquery.md.bootstrap.datetimepicker');
require('sweetalert');
// require('./admin/demo.js');

window.axios = require('axios');



window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



var arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
$('.translate').text(function(i, v) {
    var chars = v.split('');
    for (var i = 0; i < chars.length; i++) {
        if (/\d/.test(chars[i])) {
            chars[i] = arabicNumbers[chars[i]];
        }
    }
    return chars.join('');
})







