import Box from "@mui/material/Box"
import Typography from "@mui/material/Typography"
import * as React from "react"
import {Button, Checkbox, Stack, TextField} from "@mui/material"
import {useContext, useState} from "react"
import {LoginFormSchema} from "../../validations/LoginFormValidation"
import AuthContext from "../../contexts/AuthContext"

function Login() {

    const [validationErrors, setValidationErrors] = useState({
        login: '',
        password: ''
    })

    const [serverErrorMessage, setServerErrorMessage] = useState('')

    const resetError = (inputName) => {
        const err = {...validationErrors}
        err[inputName] = ''
        setValidationErrors(err)
    }

    const {logIn, setStayLoggedIn} = useContext(AuthContext)

    const handleSubmit = (e) => {
        e.preventDefault()

        const inputs = e.target.querySelectorAll('input[type=text]')
        const credentials = Object.fromEntries(
            [...inputs].map(input => [input.name, input.value])
        )

        LoginFormSchema.validate(credentials, {abortEarly: false})
            .then(function (data) {
                logIn(
                    data.login,
                    data.password,
                    error => setServerErrorMessage(error.response.data.message)
                )
            })
            .catch(function (errors) {

                const inputErrors = Object.fromEntries(
                    errors.inner.map(error => [error.path, error.message])
                )
                setValidationErrors(inputErrors)
            })
    }

    return (
        <Box sx={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            minWidth: 260,
            maxWidth: 600,
            boxShadow: 24,
            p: 4,
        }}>
            <form onSubmit={handleSubmit}>
                <Typography variant="h5" component="h2" sx={{p: 2, textAlign: "center", paddingBottom: 2}}>
                    Log in
                </Typography>
                <Typography component="p" color="error">
                    {serverErrorMessage}
                </Typography>
                <br/>
                <Stack spacing={1}>
                    <TextField
                        label="Login"
                        name="login"
                        placeholder="whatever@mail.net"
                        variant="standard"
                        error={!!validationErrors.login}
                        helperText={validationErrors.login}
                        onFocus={() => resetError('login')}
                    />
                    <TextField
                        label="Password"
                        name="password"
                        placeholder="password"
                        variant="standard"
                        error={!!validationErrors.password}
                        helperText={validationErrors.password}
                        onFocus={() => resetError('password')}
                    />
                    <br/>
                    <Typography component="span" sx={{textAlign: "center", fontSize: 16}}>
                        Remember me
                        <Checkbox
                            label="Remember"
                            onChange={(e, isChecked)=>{
                                setStayLoggedIn(isChecked)
                            }}
                        />
                    </Typography>
                    <Button type="submit" sx={{p: 2}}>
                        <Typography variant="h6" component="span">
                            Submit
                        </Typography>
                    </Button>
                </Stack>
            </form>
        </Box>
    )
}

export default Login