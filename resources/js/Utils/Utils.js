// resources/js/Utils.js
import moment from 'moment-timezone';
import Swal from "sweetalert2";

export default class Utils {
    static fecha(fechaData) {
        return moment.tz(fechaData, 'America/La_Paz').format('YYYY-MM-DD HH:MM a');
    }

    static onValidateName(e){
        console.log(e);
        return !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/.test(e);
    }

    static onValidateUserNick(e)  {
        console.log(e);
        return !/^[a-zA-Z0-9]{3,40}$/.test(e);
    }

    static onValidateEmail(e) {
        console.log(e);
        return !/^[a-zA-Z0-9.]+@[a-zA-Z]+\.[a-zA-Z]+$/.test(e);
    }

    static swalConfirmDelete(callback) {
        Swal.fire({
            title: 'Estas seguro de eliminar esta información?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro!',
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }

    static swal(title, text, icon) {
        Swal.fire(
            title,
            text,
            icon
        );
    }
}
