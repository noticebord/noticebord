import api from "./api";
import { CreateNoticeRequest } from "./models/CreateNoticeRequest";
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
 * @param {CreateNoticeRequest} request The notice to create.
 */
export async function createNoticeAsync(request: CreateNoticeRequest): Promise<Notice> {
    const response = await api.post<Notice>("/notices", request);
    return response.data;
}