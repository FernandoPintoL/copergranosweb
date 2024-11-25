// resources/js/Utils.js
import moment from 'moment-timezone';

export default class Utils {
    static fecha(fechaData) {
        return moment.tz(fechaData, 'America/La_Paz').format('YYYY-MM-DD HH:MM a');
    }
}
