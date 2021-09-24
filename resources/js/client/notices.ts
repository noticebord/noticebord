import api from "./api";
import { Notice, SaveNoticeRequest } from "./models";

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
 * @param {SaveNoticeRequest} request The notice to create.
 */
export async function createNoticeAsync(request: SaveNoticeRequest): Promise<Notice> {
    const response = await api.post<Notice>("/notices", request);
    return response.data;
}

/**
 * Update an existing notice
 * 
 * @param {number} id The id of the notice to update.
 * @param {SaveNoticeRequest} request The notice to create.
 */
 export async function updateNoticeAsync(id: number, request: SaveNoticeRequest): Promise<Notice> {
    const response = await api.put<Notice>(`/notices/${id}`, request);
    return response.data;
}

/**
 * Delete an existing notice
 * 
 * @param {number} id The id of the notice to delete.
 */
 export async function deleteNoticeAsync(id: number): Promise<void> {
    await api.delete<Notice>(`/notices/${id}`);
}