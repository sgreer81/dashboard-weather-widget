import React from 'react'
import {render} from 'react-dom'

import WeatherWidget from './WeatherWidget'

render(
    <WeatherWidget />,
    window.document.getElementById('weatherRoot')
)
