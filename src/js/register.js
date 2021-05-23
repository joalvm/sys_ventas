class Register {
    constructor() {
        this.container = $('#frm-register');

        this.inputs = new Map();
        this.data = new Map();


        this.init();
    }

    init() {
        this.container.find('.form-control').each((index, element) => {
            this.inputs.set(element.name, element);
            this.data.set(element.name, this.cleanValue(element.value));

            $(element).on('change', this.onChangeInput.bind(this));
        });

        $(this.inputs.get('email')).on('change', this.onChangeEmail.bind(this));
    }

    onChangeEmail(event) {
        var value = event.currentTarget.value;

        this.inputs.get('username').value = value ? value.split('@')[0] : '';

        $(this.inputs.get('username')).trigger('change');
    }

    onChangeInput(event) {
        var element = event.currentTarget;

        this.data.set(element.name, this.cleanValue(element.value));
    }

    cleanValue(value) {
        return value.trim() ? value.trim() : null;
    }
}

$(function () {
    new Register();
});
