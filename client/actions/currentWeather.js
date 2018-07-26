import Axios from 'axios'

const currentWeather = async city => {
    const response = await Axios.get('/wp-json/Weather/v1/current/')

    return response.data
}

export default currentWeather