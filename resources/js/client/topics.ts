import api from "./api";
import { Topic } from "./models";

/**
 * Fetch a list of all topics.
 */
 export async function fetchTopicsAsync(): Promise<Array<Topic>> {
    const response = await api.get<Array<Topic>>("/topics");
    return response.data;
}