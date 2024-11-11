import axios from 'axios';

const httpSerivce = axios.create({
    baseURL: 'http://localhost:8001/api/',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export const login = async (user) => {
    return await httpSerivce.post('login', user);
}

export const register = async (user) => {
    return await httpSerivce.post('register', user);
}