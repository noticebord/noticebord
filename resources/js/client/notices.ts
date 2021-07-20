import api from "./api";
import { Notice } from "./models/Notice";

/**
 * Fetch a list of all notices.
 */
export async function fetchNoticesAsync(): Promise<Array<Notice>> {
    const response = await api.get<Array<Notice>>("/notices");
    return response.data;
}

/**
 * Fetch a single notice by ID
 *
 * @param {Number} id The id of the notice to find.
 */
export async function fetchNoticeAsync(id: number): Promise<Notice> {
    const response = await api.get<Notice>(`/notices/${id}`);
    return response.data;
}

/**
 * Create a new notice
 * 
 * @param {Notice} notice The notice to create.
 */
export async function createNoticeAsync(title: string, body: string): Promise<Notice> {
    const response = await api.post<Notice>("/notices", { title, body });
    return response.data;
}