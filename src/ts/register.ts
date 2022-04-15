class Register {
    container: HTMLFormElement;
    inputs: Map<string, HTMLInputElement|HTMLSelectElement> = new Map();
    data: Map<string, any> = new Map();

    constructor() {
        this.container = document.getElementById('frm-register') as HTMLFormElement;

        this.init();
    }

    init() {
        this.container
            .querySelectorAll<HTMLInputElement|HTMLSelectElement>('.form-control')
            .forEach((element) => {
                this.inputs.set(element.name, element);
                this.data.set(element.name, this.cleanValue(element.value));

                EventHandler.on(element, 'change', this.onChangeInput.bind(this));
            });

        EventHandler.on(this.inputs.get('email'), 'change',  this.onChangeEmail.bind(this));
    }

    onChangeEmail(event: Event) {
        var value = (event.currentTarget as HTMLInputElement).value;
        let element = this.inputs.get('username') as HTMLInputElement;

        element.value = value ? value.split('@')[0] : '';

        EventHandler.trigger(this.inputs.get('username'), 'change');
    }

    onChangeInput(event: Event) {
        var element = event.currentTarget as HTMLInputElement;

        this.data.set(element.name, this.cleanValue(element.value));
    }

    cleanValue(value: string) {
        return value.trim() ? value.trim() : null;
    }
}

new Register();

export default Register;
