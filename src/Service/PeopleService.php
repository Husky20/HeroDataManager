<?php

namespace App\Service;

use App\Entity\People;
use Doctrine\ORM\EntityManagerInterface;

class PeopleService
{
    const PEOPLE_URL = 'https://swapi.dev/api/people/';

    private EntityManagerInterface $entityManager;
    private DataService $dataService;

    public function __construct(EntityManagerInterface $entityManager, DataService $dataService)
    {
        $this->entityManager = $entityManager;
        $this->dataService = $dataService;
    }

    public function fetchAndSavePeople(): void
    {
        $baseUrl = self::PEOPLE_URL;
        $page = 1;

        while ($page <= $this->dataService->getNumberOfPages($baseUrl)) {
            $url = $baseUrl.'?page='.$page;

            try {
                $peopleData = $this->dataService->getDataFromApiWithGuzzle($url);
            } catch (\Throwable $e) {
                break;
            }

            if (empty($peopleData['results'])) break;

            $this->processPeopleData($peopleData['results']);

            $page++;
        }
    }

    private function processPeopleData(array $peopleData): void
    {
        $existingPeopleNames = $this->getExistingPeopleNames();
        $peopleToPersist = [];

        foreach ($peopleData as $peopleDataItem) {
            if (!in_array($peopleDataItem['name'], $existingPeopleNames, true)) {

                $people = new People();

                $people->setName($peopleDataItem['name']);
                $people->setHeight((int)$peopleDataItem['height']);
                $people->setMass((int)$peopleDataItem['mass']);
                $people->setHairColor($peopleDataItem['hair_color']);
                $people->setSkinColor($peopleDataItem['skin_color']);
                $people->setEyeColor($peopleDataItem['eye_color']);
                $people->setBirthYear($peopleDataItem['birth_year']);
                $people->setGender($peopleDataItem['gender']);

                $people->setHomeworld($peopleDataItem['homeworld']);
                $people->setFilms($peopleDataItem['films']);
                $people->setSpecies($peopleDataItem['species']);
                $people->setVehicles($peopleDataItem['vehicles']);
                $people->setStarships($peopleDataItem['starships']);

                $people->setUrl($peopleDataItem['url']);

                $people->setCreatedAt(new \DateTimeImmutable('now'));
                $people->setUpdatedAt(new \DateTimeImmutable('now'));

                $peopleToPersist[] = $people;
            }
        }

        if (!empty($peopleToPersist)) {
            $this->persistPeople($peopleToPersist);
        }
    }

    private function getExistingPeopleNames(): array
    {
        $existingPeopleNames = [];
        $existingPeople = $this->entityManager->getRepository(People::class)->findAll();

        foreach ($existingPeople as $people) {
            $existingPeopleNames[] = $people->getName();
        }

        return $existingPeopleNames;
    }

    private function persistPeople(array $people): void
    {
        $this->entityManager->transactional(function ($em) use ($people){
            foreach ($people as $personIt) {
                $em->persist($personIt);
            }
            $em->flush();
        });
    }


}
