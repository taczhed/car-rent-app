const checkToday = () => {
    return new Date().toISOString().split('T')[0]
}

export default checkToday