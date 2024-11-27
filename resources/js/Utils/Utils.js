// resources/js/Utils.js
import moment from 'moment-timezone';

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
}
