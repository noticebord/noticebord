export function getParam(url: string, key: string) {
    let paramString = url.split('?')[1];
    let queryString = new URLSearchParams(paramString);
    return queryString.get(key);
}