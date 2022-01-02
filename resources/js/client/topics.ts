import { api } from "./api";
import { Notice, Paginated, Topic } from "./models";

/**
 * Fetch a list of all topics.
 */
export async function fetchTopicsAsync(): Promise<Topic[]> {
    const response = await api.get<Topic[]>("/topics");
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
export async function fetchTopicNoticesAsync(topic: number, cursor?: string): Promise<Paginated<Notice[]>> {
    const response = await api.get<Paginated<Notice[]>>(`/topics/${topic}/notices`, {
        params: { cursor },
    });
    return response.data;
}