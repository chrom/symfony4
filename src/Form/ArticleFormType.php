<?php


namespace App\Form;


use App\Entity\Article;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ArticleFormType constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Article $article */
        $article = $options['data'] ?? null;
        $isEdit = $article && $article->getId();
        $builder
            ->add('content', TextareaType::class, [
                'help' => 'Choose something catchy!',
            ])
            ->add('title')
            ->add('author', UserSelectTextType::class,
                ['disabled' => $isEdit]
            )
            ->add('location', ChoiceType::class, [
                'choices' => [
                    'The Solar System' => 'solar_system',
                    'Near a star' => 'star',
                    'Interstellar Space' => 'interstellar_space'
                ],
                'required' => false,])
            ->add('specificLocationName', ChoiceType::class, [
                'placeholder' => 'Where exactly?',
                'choices' => [
                    'TODO' => 'TODO'
                ],
                'required' => false,
            ]);
        if ($options['include_published_at']) {
            $builder->add('publishedAt', null, [
                'widget' => 'single_text'
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Article::class,
            'include_published_at' => false]);
    }

}