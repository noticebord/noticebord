import { api } from "./api";
import { Notice, Paginated, SaveTeamNoticeRequest } from "./models";

/**
 * Fetch a list of all notices.
 * 
 * @param {Number} team The team ID
 */
export async function fetchTeamNoticesAsync(team: number, cursor?: string): Promise<Paginated<Notice[]>> {
    const response = await api.get<Paginated<Notice[]>>(`/teams/${team}/notices`, {
        params: { cursor },
    });
    return response.data;
}

/**
 * Fetch a single notice by ID
 *
 * @param {Number} team The team ID
 * @param {Number} id The id of the notice to find.
 */
export async function fetchTeamNoticeAsync(team: number, id: number): Promise<Notice> {
    const response = await api.get<Notice>(`/teams/${team}/notices/${id}`);
    return response.data;
}

/**
 * Create a new notice
 * 
 * @param {Number} team The team ID
 * @param {SaveTeamNoticeRequest} request The notice to create.
 */
export async function createTeamNoticeAsync(team: number, request: SaveTeamNoticeRequest): Promise<Notice> {
    const response = await api.post<Notice>(`/teams/${team}/notices`, request);
    return response.data;
}

/**
 * Update an existing notice
 * 
 * @param {Number} team The team ID
 * @param {number} id The id of the notice to update.
 * @param {SaveTeamNoticeRequest} request The notice to create.
 */
export async function updateTeamNoticeAsync(team: number, id: number, request: SaveTeamNoticeRequest): Promise<Notice> {
    const response = await api.put<Notice>(`/teams/${team}/notices/${id}`, request);
    return response.data;
}

/**
 * Delete an existing notice
 * 
 * @param {Number} team The team ID
 * @param {number} id The id of the notice to delete.
 */
export async function deleteTeamNoticeAsync(team: number, id: number): Promise<void> {
    await api.delete(`/teams/${team}/notices/${id}`);
}