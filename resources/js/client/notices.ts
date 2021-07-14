import api from "./api";
import { Notice } from "./models/Notice";

/**
 * Get a list of all notices.
 */
export async function getNoticesAsync(): Promise<Array<Notice>> {
    const response = await api.get<Array<Notice>>("/notices");
    return response.data;
}

/**
 * Get a single notice by ID
 *
 * @param {Number} id The id of the notice to find.
 */
export async function getNoticeAsync(id: number): Promise<Notice> {
    const response = await api.get<Notice>(`/notices/${id}`);
    return response.data;
}