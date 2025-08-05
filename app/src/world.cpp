#include "world.hpp"

World* World::Open(const std::filesystem::path& path) {
    if(!std::filesystem::exists(path))
        return nullptr;
    
    World* w = new World();
    if(!w->set_world(path)) {
        delete w;
        return nullptr;
    }

    return new World();
}

bool World::set_world(const std::filesystem::path& path) {
    return true;
}