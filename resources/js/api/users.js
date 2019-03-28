import axios from 'axios'

export default {
  fetch () {
    return axios.get('/api/users')
  },
  update (user) {
    return axios.put('/api/user', {
      'name': user.name,
      'email': user.email
    })
  }
}
