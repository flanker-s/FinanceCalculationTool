import {createContext, useState} from "react"

const NavigationContext = createContext()

const initialRoutes = {
    Home: '/',
    Incomes: '/incomes',
    Expenses: '/expenses',
    Users: '/users'
}

export const NavigationProvider = ({children}) => {
    const [routes, setState] = useState(initialRoutes)

    return(
        <NavigationContext.Provider value={{
            routes
        }}>
            {children}
        </NavigationContext.Provider>
    )
}

export default NavigationContext