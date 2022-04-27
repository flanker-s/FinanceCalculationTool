import {createContext, useState} from "react"

const BurgerMenuContext = createContext()

export const BurgerMenuProvider = ({children}) => {

    const [isActive, setActivity] = useState(false)
    return (
        <BurgerMenuContext.Provider value={{
            isActive,
            setActivity
        }}>
            {children}
        </BurgerMenuContext.Provider>
    )
}
export default BurgerMenuContext