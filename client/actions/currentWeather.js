import Axios from 'axios'

const currentWeather = async () => {
    const response = await Axios.get('/wp-json/Weather/v1/current/')

    return response.data
}

export default currentWeather
