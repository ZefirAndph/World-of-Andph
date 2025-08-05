#ifndef WORLD_HPP
#define WORLD_HPP

class World {
    public:
        static World* Open(const std::filesystem::path& path);
};

#endif