window.Dropdown = require('bootstrap/js/dist/dropdown');
window.Collapse = require('bootstrap/js/dist/collapse');
window.Modal = require('bootstrap/js/dist/modal');
window.Tab = require('bootstrap/js/dist/tab');
window.Toast = require('bootstrap/js/dist/toast');

class Admin {
    btnMenu: HTMLLinkElement;

    constructor() {
        this.btnMenu = document.getElementById('navbar-menu') as HTMLLinkElement;

        console.log(new Dropdown(this.btnMenu));
    }
}

new Admin();

export default Admin;
