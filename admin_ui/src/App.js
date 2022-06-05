import {Routes, Route} from "react-router-dom"
import Header from "./components/layout/Header/Header"
import Footer from "./components/layout/Footer/Footer"
import Home from "./pages/Home/Home"
import {Container} from "@mui/material"
import React, {useContext} from "react"
import NavigationContext from "./providers/Navigation/NavigationContext"
import AuthContext from "./providers/Authentication/AuthContext"
import Login from "./pages/Login/Login"
import Loading from "./pages/Loading/Loading"
import Incomes from "./pages/ClientResources/Incomes/Incomes"
import Expenses from "./pages/ClientResources/Expenses/Expenses"
import Users from "./pages/Users/Users"

function App() {
    const {routes} = useContext(NavigationContext)
    const {status, auth} = useContext(AuthContext)

    switch (status) {
        case 'checking': auth(); return (
            <Loading />
        )
        case 'authenticated': return (
                    <>
                        <Header/>
                        <main>
                            <Container sx={{height: '100%',}}>
                                <Routes>
                                    <Route exact path={routes.Home} element={<Home/>}/>>
                                    <Route path={routes.Incomes} element={<Incomes/>}/>
                                    <Route path={routes.Expenses} element={<Expenses/>}/>
                                    <Route path={routes.Users} element={<Users/>}/>
                                </Routes>
                            </Container>
                        </main>
                        <footer>
                            <Footer/>
                        </footer>
                    </>
        )
        case 'unauthenticated': return (
            <Login/>
        )
    }
}

export default App