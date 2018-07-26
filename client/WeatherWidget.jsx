import React, { Component } from 'react'

import styles from './WeatherWidget.scss'
import currentWeather from './actions/currentWeather'

class WeatherWidget extends Component {
    constructor() {
        super()

        this.state = {
            loading: true,
            weather: {},
            error: false,
        }
    }

    componentDidMount() {
        currentWeather()
            .then(response => {
                this.setState({ loading: false, weather: response, error: false })
            })
            .catch(e => {
                console.error(error)
                this.setState({ loading: false, error: true })
            })
    }

    /**
     * Transform string to Title Case
     * 
     * @param {string} string
     */
    toTitleCase(string) {
        if (typeof string !== 'string') {
            return ''
        }
        return string.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
        })
    }

    render() {
        const { loading, weather, error } = this.state

        if (loading) {
            return <p>Loading...</p>
        }

        if (error) {
            return <p>There was an error fetching the weather</p>
        }

        const temp = Math.round(weather.temp)

        return (
            <div className={styles.weather}>
                <div className={styles.left}>
                    <p>
                        {temp}
                        <sup>&#8457;</sup>
                    </p>
                </div>
                <div className={styles.right}>
                    <p className={styles.location}>Currently in {weather.city}</p>
                    <p>{this.toTitleCase(weather.description)}</p>
                    <p>Humidity {weather.humidity}%</p>
                </div>
            </div>
        )
    }
}

export default WeatherWidget
