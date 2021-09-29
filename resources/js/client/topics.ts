import api from "./api";
import { Notice, Topic } from "./models";

/**
 * Fetch a list of all topics.
 */
export async function fetchTopicsAsync(): Promise<Array<Topic>> {
    const response = await api.get<Array<Topic>>("/topics");
    return response.data;
}

/**
 * Fetch a single topic.
 * 
 * @param {Number} topic The topic ID.
 */
 export async function fetchTopicAsync(topic: number): Promise<Topic> {
    const response = await api.get<Topic>(`/topics/${topic}`);
    return response.data;
}

/**
 * Fetch a list of all topic notices.
 * 
 * @param {Number} topic The topic ID.
 */
export async function fetchTopicNoticesAsync(topic: number): Promise<Array<Notice>> {
    const response = await api.get<Array<Notice>>(`/topics/${topic}/notices`);
    return response.data;
}