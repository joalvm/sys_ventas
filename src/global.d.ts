import EventHandlerBase from '../node_modules/bootstrap/js/src/dom/event-handler';
import {
    Dropdown as DropdownBase,
    Alert as AlertBase,
    Button as ButtonBase,
    Tooltip as TooltipBase,
    Collapse as CollapseBase,
    Modal as ModalBase,
    Tab as TabBase,
    Toast as ToastBase,
} from "bootstrap";

declare global {
    const EventHandler = EventHandlerBase;

    class Dropdown extends DropdownBase {};
    class Alert extends AlertBase {};
    class Button extends ButtonBase {};
    class Tooltip extends TooltipBase {};
    class Collapse extends CollapseBase {};
    class Modal extends ModalBase {};
    class Tab extends TabBase {};
    class Toast extends ToastBase {};

    interface Window {
        EventHandler: typeof EventHandler,
        Dropdown: typeof Dropdown,
        Alert: typeof Alert,
        Button: typeof Button,
        Tooltip: typeof Tooltip,
        Collapse: typeof Collapse,
        Modal: typeof Modal,
        Tab: typeof Tab,
        Toast: typeof Toast,
    }
}
