import {createContext, useState} from "react"
import {api} from "../connections/ApiConnection"
import useToken from "../hooks/useToken"

const AuthContext = createContext()

export const AuthProvider = ({children}) => {
    const [status, setStatus] = useState('checking')
    const [user, setUser] = useState(null)
    const [stayLoggedIn, setStayLoggedIn] = useState(false)

    const {getToken, setToken} = useToken()

    const auth = () => {
        api.get('/user', {
            headers: {
                Authorization: `Bearer ${getToken()}`
            }
        })
            .then(({data}) => {
                setStatus('authenticated')
                setUser(data.data)
            })
            .catch((err) => {
                setStatus('unauthenticated')
            })
    }

    const logIn = (email, password, errorCallback) => {

        api.post('/login',
            {
                email: email,
                password: password
            },
            {
                headers: {
                    Accept: 'application/json',
                }
            }).then(({data}) => {
                setToken(data.access_token, stayLoggedIn)
            setUser(data.user)
            setStatus('authenticated')
        }).catch(error => errorCallback(error))
    }

    const logOut = () => {
        localStorage.clear()
        sessionStorage.clear()
        setStatus('unauthenticated')
    }

    return (
        <AuthContext.Provider value={{
            auth,
            logIn,
            logOut,
            setStayLoggedIn,
            status,
            user,
        }}>
            {children}
        </AuthContext.Provider>
    )
}

export default AuthContext