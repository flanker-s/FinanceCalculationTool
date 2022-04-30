import * as yup from "yup"

export const LoginFormSchema = yup.object().shape({
    login: yup.string().required('Login is required').email('Enter correct email'),
    password: yup.string().required('Password is required')
});