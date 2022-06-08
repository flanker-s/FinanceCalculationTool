import Loading from './Loading'

function LoadingSwitch({status, completed, error}) {
    switch (status) {
        case 'processing': return <Loading/>
        case 'completed' : return completed
        case 'error' : return error
    }
}

export default LoadingSwitch