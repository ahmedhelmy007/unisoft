<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Move1
 *
 * @ORM\Table(name="MOVE1")
 * @ORM\Entity
 */
class Move1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="RESET", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $reset;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESET_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $resetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="BRANCH", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $branch;

    /**
     * @var integer
     *
     * @ORM\Column(name="BATCH", type="integer", nullable=true)
     */
    private $batch;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VDATE", type="datetime", nullable=true)
     */
    private $vdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="SR", type="integer", nullable=true)
     */
    private $sr;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME_TO", type="string", length=100, nullable=true)
     */
    private $nameTo;

    /**
     * @var string
     *
     * @ORM\Column(name="DETAILS", type="string", length=500, nullable=true)
     */
    private $details;

    /**
     * @var integer
     *
     * @ORM\Column(name="CHEK", type="integer", nullable=true)
     */
    private $chek;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CHEK_DATE", type="datetime", nullable=true)
     */
    private $chekDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="USER_NO", type="integer", nullable=true)
     */
    private $userNo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TIME_STAMP", type="datetime", nullable=true)
     */
    private $timeStamp;

    /**
     * @var integer
     *
     * @ORM\Column(name="CHEK_FLAGE", type="integer", nullable=true)
     */
    private $chekFlage;

    /**
     * @var string
     *
     * @ORM\Column(name="BANK", type="string", length=50, nullable=true)
     */
    private $bank;

    /**
     * @var integer
     *
     * @ORM\Column(name="TEMP1", type="integer", nullable=true)
     */
    private $temp1;

    /**
     * @var integer
     *
     * @ORM\Column(name="TEMP2", type="integer", nullable=true)
     */
    private $temp2;

    /**
     * @var string
     *
     * @ORM\Column(name="DETAILS_1", type="string", length=500, nullable=true)
     */
    private $details1;

    /**
     * @var integer
     *
     * @ORM\Column(name="CURRENCY_TYPE", type="integer", nullable=true)
     */
    private $currencyType;

    /**
     * @var integer
     *
     * @ORM\Column(name="CURRENCY_RATE", type="integer", nullable=true)
     */
    private $currencyRate;

    /**
     * @var integer
     *
     * @ORM\Column(name="POST_FLAGE", type="integer", nullable=true)
     */
    private $postFlage;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRINT_USR", type="integer", nullable=true)
     */
    private $printUsr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PRINT_DTM", type="datetime", nullable=true)
     */
    private $printDtm;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRINT_NO", type="integer", nullable=true)
     */
    private $printNo;

    /**
     * @var string
     *
     * @ORM\Column(name="CHECK_BOOK", type="string", length=50, nullable=true)
     */
    private $checkBook;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAID", type="integer", nullable=true)
     */
    private $paid;

    /**
     * @var string
     *
     * @ORM\Column(name="SITE_REQUISITION", type="string", length=20, nullable=true)
     */
    private $siteRequisition;

    /**
     * @var string
     *
     * @ORM\Column(name="ADD_VOUCHER_USER", type="string", length=16, nullable=true)
     */
    private $addVoucherUser;

    /**
     * @var string
     *
     * @ORM\Column(name="LUPDATE_VOUCHER_USER", type="string", length=16, nullable=true)
     */
    private $lupdateVoucherUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="APPROVED", type="integer", nullable=true)
     */
    private $approved;

    /**
     * @var integer
     *
     * @ORM\Column(name="TYP", type="integer", nullable=true)
     */
    private $typ;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTER_COMPANY", type="integer", nullable=true)
     */
    private $interCompany;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="POST_DATE", type="datetime", nullable=true)
     */
    private $postDate;

    /**
     * @var string
     *
     * @ORM\Column(name="POST_USER", type="string", length=16, nullable=true)
     */
    private $postUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="APPROVED_DATE", type="datetime", nullable=true)
     */
    private $approvedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="APPROVED_USER", type="string", length=16, nullable=true)
     */
    private $approvedUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSTED", type="integer", nullable=true)
     */
    private $posted;


}
