import {notifications} from "./notifications";

export const validations = {
    mixins: [notifications],
    methods: {
        isNumber (evt) {
            const charCode = evt.which ? evt.which : evt.keyCode
            if (
                charCode > 31 &&
                (charCode < 48 || charCode > 57) &&
                charCode !== 46
            ) {
                evt.preventDefault()
            }
        },
        isGraterThan (value, min, name) {
            const endValue = value.length < min
            if (endValue) {
                this.notify(`${name} must be greater than ${min}`, 'error')
                return !endValue
            }
            return true
        },
        isCorrectTelephone (value) {
            const countryCode = value.substring(0, 3)
            if (!countryCode) {
                alert('Telephone must be of format 234901234**** ')
            }
            return countryCode === '234'
        },
        isEmail (value) {
            this.isNotEmpty(value, "Email")
            const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/
            const testValue = emailRegex.test(value)
            if (!testValue) {
                this.notify(`Enter valid email`, 'error')
                return testValue
            }
            return testValue
        },
        isNotEmpty (value, name) {
            const inItEmpty = value.length >= 1
            if (!inItEmpty) {
                this.notify(`${name} is empty`, 'error')
                return inItEmpty
            }
            return inItEmpty
        },
        confirmPassword(value, confirmPassword) {
            const inItEmpty = value === confirmPassword
            if (!inItEmpty) {
                this.notify(`Passwords do not match`, 'error')
                return inItEmpty
            }
            return inItEmpty
        }
    },
}