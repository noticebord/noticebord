import { Notice, Topic, User } from "../client/models";

const defaultUser: User = {
    id: 0,
    name: "[Anonymous]",
    email: "",
    profile_photo_url: "https://ui-avatars.com/api/?name=Anonymous&color=7F9CF5&background=EBF4FF",
    created_at: ""
}

export function assignDefaultAuthor(notice: Notice): Notice {
    notice.author ??= defaultUser;
    return notice;
}

export function generateTopicCounts(notices: Notice[]): Map<string, { topic: Topic, count: number }> {
    const map = new Map<string, { topic: Topic, count: number }>();

    for (const { topics } of notices) {
        for (const topic of topics) {
            map.set(topic.name, {
                topic,
                count: map.has(topic.name)
                    ? map.get(topic.name)!.count + 1
                    : 1
            });
        }
    }

    return new Map([...map.entries()].sort(([, { count: a }], [, { count: b }]) =>
        a < b ? 1 : a > b ? -1 : 0));
}

export function determineMostFrequent(map: Map<string, { topic: Topic, count: number }>): Topic[] {
    let first = true;
    let max = 0;
    const frequent: Topic[] = [];

    for (const item of map) {
        if (first) {
            max = item[1].count;
            frequent.push(item[1].topic);
            first = false;
        } else if (item[1].count >= max) frequent.push(item[1].topic);
    }

    return frequent;
}