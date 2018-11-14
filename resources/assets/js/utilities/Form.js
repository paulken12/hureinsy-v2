import Errors from './Errors';
import {Vue as Toasted} from "vue-toasted";

class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }


    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url) {
        return this.submit('post', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('patch', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url) {

        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(({data}) => {
                    resolve(data);
                })
                /*.then(response => {
                    this.onSuccess(response.data());
                    // this.onSuccess(window.location = response.data.redirect);
                    resolve(response.data);
                })*/
                .catch(error => {
                    this.onFail(
                        error.response.data,
                        error.response.status,
                        error.response.statusText
                    );

                    reject(error);
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        this.reset();
    }

    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     * @param {number} status
     * @param {string} statusText
     */
    onFail(errors, status, statusText) {

        if (status === 422) {
            this.errors.record(errors);
        } else {
            this.errors.record({
                general: {
                    0: status + ' ' + statusText
                }
            });
        }

        return this;
    }
}


export default Form;