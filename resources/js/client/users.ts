import { api } from "./api";
import { Notice, User } from "./models";

/**
 * Fetch a list of all users.
 * 
 * @returns An array of all users.
 */
 export async function fetchUsersAsync(): Promise<User[]> {
    const response = await api.get<User[]>("/users");
    return response.data;
}

/**
 * Fetch a single user.
 * 
 * @param user The user ID
 * @returns The user
 */
export async function fetchUserAsync(user: number): Promise<User> {
    const response = await api.get<User>(`/users/${user}`);
    return response.data;
}

/**
 * Fetch a list of all notices belonging to a user.
 * 
 * @param team The user ID
 * @returns A list of notices belonging to the user.
 */
export async function fetchUserNoticesAsync(user: number): Promise<Notice[]> {
    const response = await api.get<Notice[]>(`/users/${user}/notices`);
    return response.data;
}

/**
 * Fetch a list of all notes belonging to a user.
 * 
 * @param team The user ID
 * @returns A list of notes belonging to the user.
 */
 export async function fetchUserNotesAsync(user: number): Promise<Notice[]> {
    const response = await api.get<Notice[]>(`/users/${user}/notes`);
    return response.data;
}