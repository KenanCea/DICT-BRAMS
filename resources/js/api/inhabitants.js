import axios from 'axios'

export default {
  fetch () {
    return axios.get('/api/inhabitants')
  },
  update (inhabitant) {
    return axios.put('/api/inhabitants', {
      'name': inhabitant.name
    })
  }
}